<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'main_street',
        'side_street',
        'alley',
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
        $address = 'خیابان '. $this->main_street;

        if ($this->side_street)
            $address .= '، خیابان '. $this->side_street;

        if ($this->alley)
            $address .= '، کوچه '. $this->alley;

        $address .= '، پلاک '. $this->house_no;

        return $address;
    }


    /**
     * Search address and get lat, long of first query
     *
     * @param $address
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function search($address)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://map.ir/search/v2', [

            'headers' => [
                'content-type' => 'application/json',
                'x-api-key' => env('MAP_IR_API_KEY'),
            ],
            'body' => json_encode([
                'text' => $address,
                '$filter' => 'province eq تهران',
            ])
        ]);

        $response = json_decode($response->getBody());
        list($long, $lat) = $response->value[0]->geom->coordinates;

        return [
            'lat' => $lat,
            'long' => $long,
        ];
    }
}
