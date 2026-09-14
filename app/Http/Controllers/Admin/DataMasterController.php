<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Fleet;
use App\Models\RentalRoute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataMasterController extends Controller
{
    public function index()
    {
        return view('admin.data-master', [
            'armada' => Fleet::orderBy('sort_order')->orderBy('id')->get()->map(fn(Fleet $item) => $this->fleetPayload($item))->values(),
            'destinasi' => Destination::orderBy('sort_order')->orderBy('id')->get()->map(fn(Destination $item) => $this->destinationPayload($item))->values(),
            'rute' => RentalRoute::with(['fleet', 'destination'])->orderBy('sort_order')->orderBy('id')->get()->map(fn(RentalRoute $item) => $this->routePayload($item))->values(),
        ]);
    }

    public function storeFleet(Request $request): JsonResponse
    {
        $data = $this->validateFleet($request);
        $fleet = Fleet::create($this->fleetData($data) + [
            'sort_order' => (int) Fleet::max('sort_order') + 1,
        ]);

        return response()->json([
            'message' => 'Armada berhasil ditambahkan.',
            'data' => $this->fleetPayload($fleet),
        ], 201);
    }

    public function updateFleet(Request $request, Fleet $fleet): JsonResponse
    {
        $data = $this->validateFleet($request);
        $fleet->update($this->fleetData($data));

        // Jika nama armada diubah, nama yang tampil pada data rute ikut diperbarui.
        RentalRoute::where('fleet_id', $fleet->id)->update([
            'fleet_name' => $fleet->name,
            'category' => $fleet->category,
        ]);

        return response()->json([
            'message' => 'Armada berhasil diperbarui.',
            'data' => $this->fleetPayload($fleet->fresh()),
        ]);
    }

    public function destroyFleet(Fleet $fleet): JsonResponse
    {
        // Relasi rental_routes menggunakan nullOnDelete agar data rute tidak ikut hilang.
        $fleet->delete();

        return response()->json(['message' => 'Armada berhasil dihapus.']);
    }

    public function storeDestination(Request $request): JsonResponse
    {
        $data = $this->validateDestination($request);
        $destination = Destination::create($this->destinationData($data) + [
            'sort_order' => (int) Destination::max('sort_order') + 1,
        ]);

        return response()->json([
            'message' => 'Destinasi berhasil ditambahkan.',
            'data' => $this->destinationPayload($destination),
        ], 201);
    }

    public function updateDestination(Request $request, Destination $destination): JsonResponse
    {
        $data = $this->validateDestination($request);
        $destination->update($this->destinationData($data));

        // Sinkronkan nama destinasi pada rute yang memilih destinasi ini.
        RentalRoute::where('destination_id', $destination->id)->update([
            'destination_name' => $destination->name,
        ]);

        return response()->json([
            'message' => 'Destinasi berhasil diperbarui.',
            'data' => $this->destinationPayload($destination->fresh()),
        ]);
    }

    public function destroyDestination(Destination $destination): JsonResponse
    {
        $destination->delete();

        return response()->json(['message' => 'Destinasi berhasil dihapus.']);
    }

    public function storeRoute(Request $request): JsonResponse
    {
        $data = $this->validateRoute($request);
        $route = RentalRoute::create($this->routeData($data) + [
            'sort_order' => (int) RentalRoute::max('sort_order') + 1,
        ]);

        return response()->json([
            'message' => 'Rute dan harga berhasil ditambahkan.',
            'data' => $this->routePayload($route->load(['fleet', 'destination'])),
        ], 201);
    }

    public function updateRoute(Request $request, RentalRoute $rentalRoute): JsonResponse
    {
        $data = $this->validateRoute($request);
        $rentalRoute->update($this->routeData($data));

        return response()->json([
            'message' => 'Rute dan harga berhasil diperbarui.',
            'data' => $this->routePayload($rentalRoute->fresh()->load(['fleet', 'destination'])),
        ]);
    }

    public function destroyRoute(RentalRoute $rentalRoute): JsonResponse
    {
        $rentalRoute->delete();

        return response()->json(['message' => 'Rute dan harga berhasil dihapus.']);
    }

    private function validateFleet(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'capacity' => ['nullable', 'string', 'max:100'],
            'facilities' => ['nullable', 'string', 'max:2000'],
            'unit_count' => ['required', 'integer', 'min:0', 'max:9999'],
            'daily_price' => ['nullable', 'integer', 'min:0'],
            'image_path' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);
    }

    private function fleetData(array $data): array
    {
        return [
            'name' => $data['name'],
            'category' => $data['category'] ?? null,
            'description' => $data['description'] ?? null,
            'capacity' => $data['capacity'] ?? null,
            'facilities' => $data['facilities'] ?? null,
            'unit_count' => $data['unit_count'],
            'daily_price' => $data['daily_price'] ?? null,
            'image_path' => $data['image_path'] ?? null,
            'is_active' => $data['is_active'],
        ];
    }

    private function validateDestination(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'route' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);
    }

    private function destinationData(array $data): array
    {
        return [
            'name' => $data['name'],
            'route' => $data['route'] ?? null,
            'description' => $data['description'] ?? null,
            'image_path' => $data['image_path'] ?? null,
            'is_active' => $data['is_active'],
        ];
    }

    private function validateRoute(Request $request): array
    {
        return $request->validate([
            'destination_id' => ['required', 'integer', 'exists:destinations,id'],
            'fleet_id' => ['required', 'integer', 'exists:fleets,id'],
            'route_description' => ['nullable', 'string', 'max:1000'],
            'price_35' => ['nullable', 'integer', 'min:0'], // Ubah dari price
            'price_41' => ['nullable', 'integer', 'min:0'], // Tambahan untuk seat 41
            'image_path' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);
    }

    private function routeData(array $data): array
    {
        $destination = Destination::findOrFail($data['destination_id']);
        $fleet = Fleet::findOrFail($data['fleet_id']);

        return [
            'destination_id' => $destination->id,
            'destination_name' => $destination->name,
            'fleet_id' => $fleet->id,
            'fleet_name' => $fleet->name,
            'route_description' => $data['route_description'] ?? null,
            'price_35' => $data['price_35'] ?? 0, // Sesuaikan
            'price_41' => $data['price_41'] ?? 0, // Sesuaikan
            'image_path' => $data['image_path'] ?? null,
            'category' => $fleet->category,
            'is_active' => $data['is_active'],
        ];
    }

    private function routePayload(RentalRoute $item): array
    {
        return [
            'id' => $item->id,
            'destination_id' => $item->destination_id,
            'destination_name' => $item->destination?->name ?? $item->destination_name,
            'fleet_id' => $item->fleet_id,
            'fleet_name' => $item->fleet?->name ?? $item->fleet_name,
            'route_description' => $item->route_description,
            'price_35' => $item->price_35 !== null ? (int) $item->price_35 : null, // Payload frontend
            'price_41' => $item->price_41 !== null ? (int) $item->price_41 : null,
            'image_path' => $item->image_path,
            'is_active' => (bool) $item->is_active,
        ];
    }

    private function fleetPayload(Fleet $item): array
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'category' => $item->category,
            'description' => $item->description,
            'capacity' => $item->capacity,
            'facilities' => $item->facilities,
            'unit_count' => (int) ($item->unit_count ?? 0),
            'daily_price' => $item->daily_price !== null ? (int) $item->daily_price : null,
            'image_path' => $item->image_path,
            'is_active' => (bool) $item->is_active,
        ];
    }

    private function destinationPayload(Destination $item): array
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'route' => $item->route,
            'description' => $item->description,
            'image_path' => $item->image_path,
            'is_active' => (bool) $item->is_active,
        ];
    }
}
