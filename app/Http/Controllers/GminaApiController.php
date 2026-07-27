<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GminaApiController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $query = $request->input('q', '');

        if (strlen($query) < 1) {
            return response()->json([]);
        }

        $results = DB::table('gminy')
            ->join('powiaty', 'powiaty.id', '=', 'gminy.powiat_id')
            ->join('wojewodztwa', 'wojewodztwa.id', '=', 'powiaty.wojewodztwo_id')
            ->where('gminy.nazwa', 'ilike', "%{$query}%")
            ->orWhere('powiaty.nazwa', 'ilike', "%{$query}%")
            ->orWhere('wojewodztwa.nazwa', 'ilike', "%{$query}%")
            ->select(
                'gminy.nazwa as value',
                'powiaty.nazwa as powiat',
                'wojewodztwa.nazwa as wojewodztwo'
            )
            ->orderBy('gminy.nazwa')
            ->limit(30)
            ->get()
            ->map(fn($row) => [
                'value' => $row->value,
                'label' => "{$row->value} (pow. {$row->powiat}, woj. {$row->wojewodztwo})",
                'powiat' => $row->powiat,
                'wojewodztwo' => $row->wojewodztwo,
            ]);

        return response()->json($results);
    }

    public function powiaty(Request $request): JsonResponse
    {
        $wojewodztwo = $request->input('wojewodztwo', '');

        if (!$wojewodztwo) {
            return response()->json(DB::table('powiaty')->orderBy('nazwa')->pluck('nazwa'));
        }

        $results = DB::table('powiaty')
            ->join('wojewodztwa', 'wojewodztwa.id', '=', 'powiaty.wojewodztwo_id')
            ->where('wojewodztwa.nazwa', $wojewodztwo)
            ->orderBy('powiaty.nazwa')
            ->pluck('powiaty.nazwa');

        return response()->json($results);
    }

    public function gminy(Request $request): JsonResponse
    {
        $powiat = $request->input('powiat', '');

        if (!$powiat) {
            return response()->json(DB::table('gminy')->orderBy('nazwa')->pluck('nazwa'));
        }

        $results = DB::table('gminy')
            ->join('powiaty', 'powiaty.id', '=', 'gminy.powiat_id')
            ->where('powiaty.nazwa', $powiat)
            ->orderBy('gminy.nazwa')
            ->pluck('gminy.nazwa');

        return response()->json($results);
    }
}
