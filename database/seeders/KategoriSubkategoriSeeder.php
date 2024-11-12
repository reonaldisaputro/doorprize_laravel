<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Subkategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSubkategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori100 = Kategori::create(['nama' => '100000']);

        Subkategori::create([
            'kategori_id' => $kategori100->id,
            'nama' => 'Voucher Indomaret 100Rb',
            'qty' => 40,
            'image' => 'subkategori/01JASYQNCJK0ZAD6DAXZ76Q3A5.png',
            'image_title' => 'subkategori_title/01JAT401RTQFQWNQKX6K93TGZG.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori100->id,
            'nama' => 'Voucher Hypermart 100Rb',
            'qty' => 30,
            'image' => 'subkategori/01JATM9WXM0S14B3QY2RWX0FKV.png',
            'image_title' => 'subkategori_title/01JAT7WFJVGWHZM5TGD6VZAB2P.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori100->id,
            'nama' => 'Voucher Alfamart 100Rb',
            'qty' => 30,
            'image' => 'subkategori/01JATNM2MNYXP93P92MBAFDJ8N.png',
            'image_title' => 'subkategori_title/01JAT7X1FP5QSC2Z9JF05NFQBE.png'
        ]);

        $kategori200 = Kategori::create(['nama' => '200000']);

        Subkategori::create([
            'kategori_id' => $kategori200->id,
            'nama' => 'Tumbler Tyeso',
            'qty' => 30,
            'image' => 'subkategori/01JAT9RPPSXW3WMRC27QCP7JS4.png',
            'image_title' => 'subkategori_title/01JAR3KTBTJAA6ZR01P5D96PD9.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori200->id,
            'nama' => 'Flazz Rp 150.000',
            'qty' => 30,
            'image' => 'subkategori/01JATEFQQ92S4YAMHJKCQ2CKF0.png',
            'image_title' => 'subkategori_title/01JAT9VM55KQ14EMPS88QNJ4QT.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori200->id,
            'nama' => 'Voucher Grab Food Rp 200.000',
            'qty' => 30,
            'image' => 'subkategori/01JAVS93PZH8BQD93E9H9541QD.png',
            'image_title' => 'subkategori_title/01JATKNQ8073RQW8ASNX9SJ7ZP.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori200->id,
            'nama' => 'Powerbank Philips',
            'qty' => 30,
            'image' => 'subkategori/01JAT7MQ0H5Z2V5QZG8NCSXJY1.png',
            'image_title' => 'subkategori_title/01JAR3V884HE9HWSNH768BQKKQ.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori200->id,
            'nama' => 'Kipas Angin Sekai',
            'qty' => 30,
            'image' => 'subkategori/01JATEK0M577N6SMPNF6K0ZCNX.png',
            'image_title' => 'subkategori_title/01JAR3X1X9AJWTF0Y8DNJAQG5G.png'
        ]);



        $kategori500 = Kategori::create(['nama' => '500000']);

        Subkategori::create([
            'kategori_id' => $kategori500->id,
            'nama' => 'JBL GO2',
            'qty' => 15,
            'image' => 'subkategori/01JAT09ZKEH9YSWA6EGN76QMGR.png',
            'image_title' => 'subkategori_title/01JATKSA3S4Q5A5V36QN9RNAC9.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori500->id,
            'nama' => 'Bodypack Daypack',
            'qty' => 10,
            'image' => 'subkategori/01JATME2XGN07VD2J2FFT77S1X.png',
            'image_title' => 'subkategori_title/01JAT8248SN6NN68ECY4CJFV25.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori500->id,
            'nama' => 'Redmi SoundBar',
            'qty' => 10,
            'image' => 'subkategori/01JATGR4C92X6VGK3MXAWN9J6G.png',
            'image_title' => 'subkategori_title/01JAT82N84SY9FTEHPZR66M2EM.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori500->id,
            'nama' => 'Voucher Superindo 500Rb',
            'qty' => 15,
            'image' => 'subkategori/01JAWTZ40871MC0HBGW2F5EC6B.png',
            'image_title' => 'subkategori_title/01JAT83WK99B41WTB3G6GPQWJE.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori500->id,
            'nama' => 'Redmi Watch 5 Active',
            'qty' => 15,
            'image' => 'subkategori/01JAC7EQTR55T6V878CTV1BF7H.png',
            'image_title' => 'subkategori_title/01JAT87C7Q9H280KHD3MT89JM2.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori500->id,
            'nama' => 'Sharp Rice Cooker',
            'qty' => 15,
            'image' => 'subkategori/01JATMPFA791Y42F87PC8RQTVF.png',
            'image_title' => 'subkategori_title/01JAT884VKN93GDFBN2JNSYHYY.png'
        ]);


        $kategori1000000 = Kategori::create(['nama' => '1000000']);

        Subkategori::create([
            'kategori_id' => $kategori1000000->id,
            'nama' => 'Philips Blender',
            'qty' => 2,
            'image' => 'subkategori/01JAT0X00570RQRD7FF08GY8ZK.png',
            'image_title' => 'subkategori_title/01JAT89PSB9XJHDNC3P8127KED.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori1000000->id,
            'nama' => 'Dispenser Miyako',
            'qty' => 2,
            'image' => 'subkategori/01JAR5WWHV1BTYAFGCTRSPPV34.png',
            'image_title' => 'subkategori_title/01JAR4GG7WMFTX4RZXWMY71BF5.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori1000000->id,
            'nama' => 'Emas 0,5 Gr',
            'qty' => 2,
            'image' => 'subkategori/01JAT9CTJR39GHYTFKY42DMX4S.png',
            'image_title' => 'subkategori_title/01JAT8AB76YTJTF4D4Y8TGM4MY.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori1000000->id,
            'nama' => 'Philips Air Fryer',
            'qty' => 2,
            'image' => 'subkategori/01JATF374M6BS92D6HW5N1E9R1.png',
            'image_title' => 'subkategori_title/01JAT8BCTTPRASRC8GMD1T46DM.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori1000000->id,
            'nama' => 'Huawei Watch Fit SE',
            'qty' => 2,
            'image' => 'subkategori/01JAT84KGER65P2T7RN1H6WJEV.png',
            'image_title' => 'subkategori_title/01JATM0CX5JG4QJ6NW23QB8KD0.png'
        ]);


        $kategori1500000 = Kategori::create(['nama' => '1500000']);

        Subkategori::create([
            'kategori_id' => $kategori1500000->id,
            'nama' => 'Xiaomi Poco C65',
            'qty' => 2,
            'image' => 'subkategori/01JAT9639PPW30APRC1456W89G.png',
            'image_title' => 'subkategori_title/01JATKVVVRNG9Y083E97WP217T.png'
        ]);

        Subkategori::create([
            'kategori_id' => $kategori1500000->id,
            'nama' => 'Emas 1 Gr',
            'qty' => 2,
            'image' => 'subkategori/01JAT99GM140S0BT4JKH38D8Y7.png',
            'image_title' => 'subkategori_title/01JAT8JBMFTQPKQWW2WTJEQ9XH.png'
        ]);

        $kategori3000000 = Kategori::create(['nama' => '3000000']);

        Subkategori::create([
            'kategori_id' => $kategori3000000->id,
            'nama' => 'Samsung Smart TV 43 Inch',
            'qty' => 3,
            'image' => 'subkategori/01JATMJRD22QW7DDB642XMK8DK.png',
            'image_title' => 'subkategori_title/01JAT8JY4GCBT48YV1W3JRWRFN.png'
        ]);
    }
}
