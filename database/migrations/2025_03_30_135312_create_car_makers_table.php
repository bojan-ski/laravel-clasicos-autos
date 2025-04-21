<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_makers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

         // Insert the car manufacturers
         $now = Carbon::now();

         $manufacturers = [
            ['name' => 'Alfa Romeo', 'description' => 'Alfa Romeo is an Italian luxury car manufacturer. Founded in Milan, Italy in 1910, the company has a long and rich history of producing stylish and high-performance vehicles, often associated with motorsport.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Aston Martin', 'description' => 'Aston Martin Lagonda Limited is a British independent manufacturer of luxury sports cars and grand tourers. Based in Gaydon, Warwickshire, England, the company is renowned for its elegant design and association with the James Bond film franchise.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Austin-Healey', 'description' => 'Austin-Healey was a British sports car marque established through a partnership between the Austin Motor Company and Donald Healey. Produced from 1952 to 1972, these cars are beloved for their classic British roadster styling and sporting character.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Bentley', 'description' => 'Bentley Motors Limited is a British manufacturer and marketer of luxury cars and SUVs. Founded in 1919, the company has a reputation for craftsmanship, performance, and opulent interiors, now operating as a subsidiary of the Volkswagen Group.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Buick', 'description' => 'Buick is an American automobile brand owned by General Motors (GM). Established in 1903, it is one of the oldest automobile brands in the United States and has historically been positioned as a premium brand within GM\'s portfolio.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cadillac', 'description' => 'Cadillac is a luxury vehicle brand owned by General Motors (GM). Founded in 1902, it is one of the oldest luxury automobile brands in the world and has long been a symbol of American automotive prestige and innovation.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chevrolet', 'description' => 'Chevrolet, colloquially referred to as Chevy, is an American automobile division of General Motors (GM). Founded in 1911, Chevrolet is one of the world\'s largest automobile brands, known for producing a wide range of affordable and popular vehicles.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chrysler', 'description' => 'Chrysler is an American automobile brand that was founded in 1925. Historically one of the "Big Three" American automakers, Chrysler has been known for its engineering innovation and distinctive styling. It is now part of Stellantis.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Citroën', 'description' => 'Citroën is a major French automobile manufacturer founded in 1919 by André Citroën. The company has a history of technological innovation and distinctive design, including the development of front-wheel drive and hydropneumatic suspension.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Datsun', 'description' => 'Datsun was a Japanese automobile brand owned by Nissan. Originally established in 1931, the Datsun brand was primarily known for producing affordable and reliable small cars. Nissan phased out the Datsun brand in various markets over time, but it was briefly revived in the 21st century for emerging markets.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'DeSoto', 'description' => 'DeSoto was an American automobile brand of the Chrysler Corporation, marketed from 1928 to 1961. Positioned in the mid-price field, DeSoto vehicles were known for their stylish designs and engineering features before the brand was discontinued.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dodge', 'description' => 'Dodge is an American brand of automobiles and a division of Stellantis. Founded as the Dodge Brothers Company in 1900, Dodge became known for its durable trucks and powerful cars, with a current focus on performance-oriented vehicles.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ferrari', 'description' => 'Ferrari S.p.A. is an Italian luxury sports car manufacturer based in Maranello, Italy. Founded by Enzo Ferrari in 1939 out of the Alfa Romeo race division as Auto Avio Costruzioni, the company is renowned for its high-performance sports cars and Formula One racing team.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fiat', 'description' => 'Fabbrica Italiana Automobili Torino (FIAT) is an Italian automobile manufacturer. Founded in 1899, Fiat has a long history of producing a wide range of vehicles, from small city cars to luxury models. It is now part of Stellantis.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ford', 'description' => 'The Ford Motor Company, commonly known as Ford, is an American multinational automaker headquartered in Dearborn, Michigan. Founded by Henry Ford and incorporated on June 16, 1903, the company is one of the world\'s largest automobile manufacturers.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hudson', 'description' => 'The Hudson Motor Car Company was an American automobile manufacturer based in Detroit, Michigan, that operated from 1909 to 1954. Hudson was known for its innovation and stylish designs, eventually merging with Nash-Kelvinator Corporation to form American Motors Corporation (AMC).', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Jaguar', 'description' => 'Jaguar Land Rover Limited is a British multinational automotive company headquartered in Whitley, Coventry, England. Originally founded as the Swallow Sidecar Company in 1922, Jaguar Cars became known for its sleek sports cars and luxury saloons.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lamborghini', 'description' => 'Automobili Lamborghini S.p.A. is an Italian manufacturer of luxury sports cars and SUVs based in Sant\'Agata Bolognese. Founded by Ferruccio Lamborghini in 1963 as a rival to Ferrari, the company is known for its powerful engines and distinctive, often flamboyant designs.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lancia', 'description' => 'Lancia is an Italian automobile manufacturer founded in 1906 by Vincenzo Lancia. The company has a history of producing innovative and elegant vehicles, with a strong presence in motorsport. It is currently part of Stellantis.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lincoln', 'description' => 'Lincoln is the luxury vehicle division of American automobile manufacturer Ford Motor Company. Marketed primarily in North America and the Middle East, Lincoln vehicles are known for their comfort, features, and elegant styling.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Maserati', 'description' => 'Maserati S.p.A. is an Italian luxury vehicle manufacturer. Established on December 1, 1914, in Bologna by Alfieri Maserati and his brothers, the company\'s motto is "Luxury, sports and style cast in exclusive cars". Maserati is now part of Stellantis.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mercedes-Benz', 'description' => 'Mercedes-Benz is a German luxury and commercial vehicle automotive brand established in 1926. Originating from the collaboration between Karl Benz\'s Benz Patent-Motorwagen and Gottlieb Daimler\'s Daimler-Motoren-Gesellschaft, Mercedes-Benz is renowned for its engineering, innovation, and high-quality vehicles.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mercury', 'description' => 'Mercury was a division of the Ford Motor Company, marketed from 1938 to 2011. Positioned as a mid-level brand between Ford and Lincoln, Mercury offered more upscale features and styling than Ford models. The brand was discontinued as part of Ford\'s restructuring.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MG', 'description' => 'MG is a British automotive marque registered by the now Chinese automotive company SAIC Motor UK Limited. The MG Car Company Limited was originally a British sports car manufacturer that began in the 1920s. Throughout its history, MG was famous for its open two-seater sports cars.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Nash', 'description' => 'Nash Motors Company was an American automobile manufacturer based in Kenosha, Wisconsin. Founded by Charles W. Nash in 1916, Nash was known for its innovative features and aerodynamic designs. It merged with Hudson in 1954 to form American Motors Corporation (AMC).', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Oldsmobile', 'description' => 'Oldsmobile was an American automobile marque produced for most of its existence by General Motors. Founded by Ransom E. Olds in 1897, it was one of the oldest automobile brands in the world. GM discontinued the Oldsmobile division in 2004.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Packard', 'description' => 'The Packard Motor Car Company was an American luxury automobile manufacturer founded in 1899. Packard built high-quality luxury cars and was highly regarded both domestically and internationally before ceasing production in 1958.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Peugeot', 'description' => 'Peugeot is a French automotive manufacturer, part of Stellantis. The company\'s roots date back to the 19th century, initially producing coffee mills and bicycles before venturing into automobiles. Peugeot is known for its stylish and practical vehicles.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Plymouth', 'description' => 'Plymouth was an American automobile brand sold by the Chrysler Corporation. Launched in 1928 to compete in the "low-priced" market segment dominated by Chevrolet and Ford, Plymouth was known for its affordability and reliability before being discontinued in 2001.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pontiac', 'description' => 'Pontiac was an American automobile brand owned by General Motors. Introduced as a companion marque for GM\'s Oakland in 1926, Pontiac became known for its sporty styling and performance. GM discontinued the Pontiac brand in 2010.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Porsche', 'description' => 'Dr. Ing. h. c. F. Porsche AG, usually shortened to Porsche, is a German automobile manufacturer specializing in high-performance sports cars, SUVs and sedans. The company is owned by Volkswagen AG, which is in turn majority-owned by Porsche Automobil Holding SE.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Renault', 'description' => 'Renault S.A. is a French multinational automobile manufacturer established in 1899. The company produces a range of cars and vans, and in the past has also manufactured trucks, tractors, tanks, buses/coaches, aircraft engines, and autorail vehicles. It is part of the Renault-Nissan-Mitsubishi Alliance.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Rolls-Royce', 'description' => 'Rolls-Royce Motor Cars Limited is a British luxury automobile manufacturer. A wholly owned subsidiary of the German BMW Group, it was established in 1998 after BMW was licensed the rights to the Rolls-Royce brand name and logo from Rolls-Royce Holdings plc and acquired the rights to the Spirit of Ecstasy and grille shape trademarks from Volkswagen AG.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Studebaker', 'description' => 'The Studebaker Corporation was an American wagon and automobile manufacturer based in South Bend, Indiana. Founded in 1852 and incorporated in 1868 under the name Studebaker Brothers Manufacturing Company, the company originally manufactured wagons for farmers, miners, and the military. Studebaker entered the automotive business in 1902 and ceased US production in 1966.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Triumph', 'description' => 'Triumph was a British car and motor manufacturing company. The Triumph Cycle Co. Ltd. was founded in 1885 and from 1889, the company produced bicycles. It began building cars in 1923. The Triumph marque is currently owned by BMW.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Volkswagen', 'description' => 'Volkswagen, often abbreviated VW, is a German automobile manufacturer founded in 1937 by the German Labour Front under Ferdinand Porsche. It is the flagship marque of the Volkswagen Group, the largest automaker by worldwide sales in 2016 and 2017.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Volvo', 'description' => 'Volvo Cars is a Swedish multinational manufacturer of luxury vehicles headquartered in Torslanda, Gothenburg. Originally founded as a subsidiary of SKF in 1927, Volvo Cars has been an independent entity since 1999 and is currently owned by the Chinese multinational automotive company Geely Holding.', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('car_makers')->insert($manufacturers);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_makers');
    }
};
