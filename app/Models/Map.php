<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Map extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'address',
        'house_no',
        'lat',
        'long',
    ];


    /**
     * Map -> belongs to "User"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Map -> belongs to "User"
     *
     * @return
     */
    public function address()
    {
        return $this->address .'، پلاک '. $this->house_no;
    }


    /**
     * Search address and get lat, long of first query
     *
     * @param $lat
     * @param $long
     * @return array
     * @throws GuzzleException
     */
    public static function search($lat, $long)
    {
        Log::info($lat);
        Log::info($long);
        $client = new Client();
//        $response = $client->request('GET', 'https://map.ir/reverse/no/', [
//
//            'headers' => [
//                'content-type' => 'application/json',
//                'x-api-key' => env('MAP_IR_API_KEY'),
//            ],
//            'body' => json_encode([
//                'lat' => $lat,
//                'lon' => $long,
//            ])
//        ]);
        $response = $client->request('GET', "https://api.neshan.org/v5/reverse?lat={$lat}&lng={$long}", [

            'headers' => [
                'Api-Key' => env('NESHAN_SERVICE_API_KEY'),
            ]
        ]);

        $response = json_decode($response->getBody());
        return $response->formatted_address;
    }
}
