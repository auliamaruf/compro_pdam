<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageNews extends ManageRecords
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    // Convert document_links to documents format
                    if (isset($data['document_links']) && is_array($data['document_links'])) {
                        $data['documents'] = $data['document_links'];
                        unset($data['document_links']);
                    }
                    
                    // Auto-set has_documents based on actual documents
                    $data['has_documents'] = $this->hasDocumentsInData($data);
                    return $data;
                })
                ->after(function ($record) {
                    // Update has_documents after media is uploaded
                    $this->updateHasDocuments($record);
                }),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Auto-set has_documents based on documents
        $data['has_documents'] = $this->hasDocumentsInData($data);
        return $data;
    }

    protected function afterSave(): void
    {
        // Update has_documents after save (for media uploads)
        if ($this->record) {
            $this->updateHasDocuments($this->record);
        }
    }

    private function hasDocumentsInData(array $data): bool
    {
        // Check if there are URL documents
        if (isset($data['documents']) && is_array($data['documents']) && count($data['documents']) > 0) {
            return true;
        }

        // Check if there are document_links (before conversion)
        if (isset($data['document_links']) && is_array($data['document_links']) && count($data['document_links']) > 0) {
            return true;
        }

        return false;
    }

    private function updateHasDocuments($record): void
    {
        if (!$record) return;

        $hasUploadedDocs = $record->getMedia('documents')->count() > 0;
        $hasUrlDocs = $record->documents && is_array($record->documents) && count($record->documents) > 0;
        $hasDocumentLinks = $record->document_links && is_array($record->document_links) && count($record->document_links) > 0;
        
        $hasDocuments = $hasUploadedDocs || $hasUrlDocs || $hasDocumentLinks;

        if ($record->has_documents !== $hasDocuments) {
            $record->update(['has_documents' => $hasDocuments]);
        }
    }
}
