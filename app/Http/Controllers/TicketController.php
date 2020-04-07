<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function get(Request $request, $id = null):JsonResponse
    {
        $result = $id ? Ticket::find($id) : Ticket::all();

        if (is_null($result)) {
            return response()->json(['message' => 'not_found'], 404);
        }
        return response()->json($result, 200);
    }

    public function post(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required|exists:user,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $ticket = Ticket::create($data);

        if (!$ticket) {
            return response()->json(['message' => 'unexpected_error'], 500);
        }

        return response()->json($ticket, 201);
    }

    public function update(Request $request, $id):JsonResponse
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required|exists:user,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $ticket = Ticket::find($id);

        if (is_null($ticket)) {
            return response()->json(['message' => 'not_found'], 404);
        }

        if (!$ticket->update($data)) {
            return response()->json(['message' => 'unexpected_error'], 500);
        }

        return response()->json($ticket, 200);
    }

    public function delete(Request $request, $id):JsonResponse
    {
        $ticket = Ticket::find($id);

        if (is_null($ticket)) {
            return response()->json(['message' => 'not_found'], 404);
        }

        if (!$ticket->delete()) {
            return response()->json(['message' => 'unexpected_error'], 500);
        }

        return response()->json([], 204);
    }

    public function getByUser(Request $request, $id = null):JsonResponse
    {
        $query = Ticket::query()->where('user_id', auth()->user()->id);

        $result = $id ? $query->whereKey($id)->first() : $query->get();

        if (is_null($result)) {
            return response()->json(['message' => 'not_found'], 404);
        }

        return response()->json($result, 200);
    }

    public function take(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if (is_null($ticket)) {
            return response()->json(['message' => 'not_found'], 404);
        } 

        $updated = $ticket->update(['is_taken' => true]);

        if (!$updated) {
            return response()->json(['message' => 'unexpected_error'], 500);
        }

        return response()->json($ticket, 200);
    }
}
