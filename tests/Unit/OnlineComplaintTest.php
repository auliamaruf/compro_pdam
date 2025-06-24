<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\OnlineComplaint;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class OnlineComplaintTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user for assignment
        User::factory()->create([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@test.com',
        ]);
    }

    /** @test */
    public function it_can_create_complaint_with_auto_generated_ticket_number()
    {
        $complaint = OnlineComplaint::create([
            'customer_name' => 'Test Customer',
            'customer_id_number' => 'PLG123456',
            'email' => 'test@email.com',
            'phone' => '081234567890',
            'address' => 'Test Address',
            'complaint_type' => 'water_quality',
            'subject' => 'Test Subject',
            'description' => 'Test Description',
            'priority' => 'medium',
            'status' => 'pending',
        ]);

        $this->assertNotNull($complaint->ticket_number);
        $this->assertStringStartsWith('TP' . date('Ymd'), $complaint->ticket_number);
        $this->assertEquals('pending', $complaint->status);
    }

    /** @test */
    public function it_can_submit_complaint_via_form()
    {
        $data = [
            'customer_name' => 'John Doe',
            'customer_id_number' => 'PLG789012',
            'email' => 'john@example.com',
            'phone' => '082345678901',
            'address' => 'Jl. Test No. 123',
            'complaint_type' => 'billing',
            'subject' => 'High Bill Issue',
            'description' => 'My bill is unusually high this month.',
            'priority' => 'medium',
        ];

        $response = $this->post(route('complaint.store'), $data);

        $this->assertDatabaseHas('online_complaints', [
            'customer_name' => 'John Doe',
            'email' => 'john@example.com',
            'complaint_type' => 'billing',
            'status' => 'pending',
        ]);

        $complaint = OnlineComplaint::where('email', 'john@example.com')->first();
        $response->assertRedirect(route('complaint.success', $complaint->ticket_number));
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->post(route('complaint.store'), []);

        $response->assertSessionHasErrors([
            'customer_name',
            'email',
            'phone',
            'address',
            'complaint_type',
            'subject',
            'description',
            'priority',
        ]);
    }

    /** @test */
    public function it_can_track_complaint_by_ticket_number()
    {
        $complaint = OnlineComplaint::create([
            'customer_name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '083456789012',
            'address' => 'Jl. Track No. 456',
            'complaint_type' => 'water_pressure',
            'subject' => 'Low Water Pressure',
            'description' => 'Water pressure is very low.',
            'priority' => 'high',
            'status' => 'in_progress',
        ]);

        $response = $this->get(route('complaint.track', ['ticket_number' => $complaint->ticket_number]));

        $response->assertStatus(200);
        $response->assertViewHas('complaint');
        $response->assertSee($complaint->ticket_number);
        $response->assertSee('Jane Doe');
    }

    /** @test */
    public function it_shows_error_for_invalid_ticket_number()
    {
        $response = $this->get(route('complaint.track', ['ticket_number' => 'INVALID123']));

        $response->assertSessionHas('error');
    }

    /** @test */
    public function it_can_assign_complaint_to_user()
    {
        $complaint = OnlineComplaint::factory()->create();
        $user = User::find(1);

        $complaint->update(['assigned_to' => $user->id]);

        $this->assertEquals($user->id, $complaint->assigned_to);
        $this->assertEquals($user->name, $complaint->assignedUser->name);
    }

    /** @test */
    public function it_can_mark_complaint_as_resolved()
    {
        $complaint = OnlineComplaint::factory()->create(['status' => 'pending']);

        $complaint->markAsResolved('Issue has been resolved', 1);

        $this->assertEquals('resolved', $complaint->fresh()->status);
        $this->assertEquals('Issue has been resolved', $complaint->fresh()->admin_response);
        $this->assertNotNull($complaint->fresh()->responded_at);
        $this->assertNotNull($complaint->fresh()->resolved_at);
    }

    /** @test */
    public function it_displays_complaint_type_correctly()
    {
        $complaint = OnlineComplaint::factory()->create(['complaint_type' => 'water_quality']);

        $this->assertEquals('Kualitas Air', $complaint->complaint_type_display);
    }

    /** @test */
    public function it_displays_status_correctly()
    {
        $complaint = OnlineComplaint::factory()->create(['status' => 'in_progress']);

        $this->assertEquals('Sedang Diproses', $complaint->status_display);
    }

    /** @test */
    public function it_displays_priority_correctly()
    {
        $complaint = OnlineComplaint::factory()->create(['priority' => 'urgent']);

        $this->assertEquals('Mendesak', $complaint->priority_display);
    }

    /** @test */
    public function it_can_handle_file_uploads()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('test-document.jpg');

        $data = [
            'customer_name' => 'Test Customer',
            'customer_id_number' => 'PLG123456',
            'email' => 'test@email.com',
            'phone' => '081234567890',
            'address' => 'Test Address',
            'complaint_type' => 'pipe_damage',
            'subject' => 'Pipe Leak',
            'description' => 'There is a pipe leak',
            'priority' => 'urgent',
            'attachments' => [$file],
        ];

        $response = $this->post(route('complaint.store'), $data);

        $complaint = OnlineComplaint::where('email', 'test@email.com')->first();

        $this->assertNotEmpty($complaint->attachments);
        $this->assertIsArray($complaint->attachments);

        $attachment = $complaint->attachments[0];
        $this->assertEquals('test-document.jpg', $attachment['original_name']);

        Storage::disk('public')->assertExists($attachment['path']);
    }
}
