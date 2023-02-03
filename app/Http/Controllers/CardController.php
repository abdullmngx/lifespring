<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'no' => 'required',
            'usage' => 'required'
        ]);

        $no = $request->no;
        $usage = $request->usage;
        $batch = uniqid('bx');

        for ($i = 0; $i < $no; $i++)
        {
            $pin = $this->randUniq(12);
            $serial = $this->randUniq(10);

            Card::unguard();
            Card::create([
                'batch' => $batch,
                'pin' => $pin,
                'serial' => $serial,
                'max_use' => $usage
            ]);
            Card::reguard();
        }

        return back()->with('message', 'Cards generated');
    }

    protected function randUniq($length)
    {
        $add = strtotime(date("Ymdhis"));
        $pin = "1234567890$add";
        $str = '';
        $max_str = strlen($pin) - 1;
        for ($a = 0; $a < $length; $a++) {
            $str .= $pin[mt_rand(0, $max_str)];
        }
        return $str;
    }

    public function destroy()
    {
        Card::where('status', 'used')->delete();
        return back()->with('message', 'cleared used cards!');
    }

    public function print(Request $request)
    {
        $batch = $request->batch;
        $cards = Card::where('batch', $batch)->get();
        $pdf = Pdf::loadView('printouts.cards', ['cards' => $cards]);
        return $pdf->stream('cards.pdf');
    }
}
