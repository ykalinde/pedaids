<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeysRequest;
use App\Models\Key;

class KeysController extends Controller
{
    public function generate()
    {
        if (Key::hasDisabled()) {
            $disabled = Key::getRandomDisabledKey();
            $disabled->enableKey();
            return response([
                "key" => $disabled->{"key"}
            ]);
        }

        do {
            $generated = $this->generateKey(9);
        } while (Key::searchKey($generated) != null);

        Key::saveKey($generated);

        return response([
            "key" => $generated
        ]);
    }

    public function disable(KeysRequest $request)
    {
        $key = Key::searchKey($request->get("key"));

        if ($key == null) {
            return response(["message" => "Key not found"], 404);
        }

        $key->disable();

        return response(["message" => "Key disabled successfully"]);
    }

    private function generateKey($length)
    {
        $characters = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ';

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
