<?php

namespace App\Http\Traits;

trait Sortable
{

    public function sort_elements($service,array $sorted_ids): array
    {
        try {
            foreach ($sorted_ids as $key => $sorted_id) {
                $service->update($sorted_id, ['sort' => $key + 1]);
            }

            return [
                'status' => 'success',
                'message' => 'Successfully sorted',
            ];
        } catch (\Exception $ex) {
            return [
                'status' => 'error',
                'message' => $ex->getMessage(),
            ];
        }
    }
}
