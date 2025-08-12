<?php

namespace Database\Seeders;

use App\Actions\OptimizeWebpImageAction;
use App\Models\Puppy;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PuppySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $puppies = [
            ['name' => 'Bella', 'trait' => 'Always happy', 'image' => '10.jpg'],
            ['name' => 'Rex', 'trait' => 'Fetches everything', 'image' => '9.jpg'],
            ['name' => 'Luna', 'trait' => 'Howls at the moon', 'image' => '8.jpg'],
            ['name' => 'Yoko', 'trait' => 'Ready for anything', 'image' => '6.jpg'],
            ['name' => 'Russ', 'trait' => 'Ready to save the world', 'image' => '5.jpg'],
            ['name' => 'Pupi', 'trait' => 'Loves cheese', 'image' => '4.jpg'],
            ['name' => 'Leia', 'trait' => 'Enjoys naps', 'image' => '3.jpg'],
            ['name' => 'Chase', 'trait' => 'Very good boi', 'image' => '2.jpg'],
            ['name' => 'Frisket', 'trait' => 'Mother of all pups', 'image' => '1.jpg'],
            ['name' => 'Max', 'trait' => 'Loves to play fetch', 'image' => '11.jpg'],
            ['name' => 'Buddy', 'trait' => 'Loyal companion', 'image' => '12.jpg'],
            ['name' => 'Charlie', 'trait' => 'Friendly and outgoing', 'image' => '13.jpg'],
            ['name' => 'Cooper', 'trait' => 'Great with kids', 'image' => '14.jpg'],
            ['name' => 'Rocky', 'trait' => 'Strong and brave', 'image' => '15.jpg'],
            ['name' => 'Bear', 'trait' => 'Gentle giant', 'image' => '16.jpg'],
            ['name' => 'Duke', 'trait' => 'Noble and proud', 'image' => '17.jpg'],
            ['name' => 'Jack', 'trait' => 'Playful and energetic', 'image' => '18.jpg'],
            ['name' => 'Tucker', 'trait' => 'Loves treats', 'image' => '19.jpg'],
            ['name' => 'Oliver', 'trait' => 'Curious explorer', 'image' => '20.jpg'],
            ['name' => 'Toby', 'trait' => 'Sweet and gentle', 'image' => '21.jpg'],
            ['name' => 'Buster', 'trait' => 'Full of energy', 'image' => '22.jpg'],
            ['name' => 'Lucky', 'trait' => 'Always finds treats', 'image' => '1.jpg'],
            ['name' => 'Milo', 'trait' => 'Loves belly rubs', 'image' => '2.jpg'],
            ['name' => 'Jake', 'trait' => 'Protective guardian', 'image' => '3.jpg'],
            ['name' => 'Bruno', 'trait' => 'Loves to swim', 'image' => '4.jpg'],
            ['name' => 'Oscar', 'trait' => 'Dignified and calm', 'image' => '5.jpg'],
            ['name' => 'Rusty', 'trait' => 'Loves the outdoors', 'image' => '6.jpg'],
            ['name' => 'Zeus', 'trait' => 'Mighty and powerful', 'image' => '7.jpg'],
            ['name' => 'Leo', 'trait' => 'Brave like a lion', 'image' => '8.jpg'],
            ['name' => 'Finn', 'trait' => 'Loves adventure', 'image' => '9.jpg'],
            ['name' => 'Ace', 'trait' => 'Top of his class', 'image' => '10.jpg'],
            ['name' => 'Gus', 'trait' => 'Loves to cuddle', 'image' => '11.jpg'],
            ['name' => 'Cody', 'trait' => 'Great listener', 'image' => '12.jpg'],
            ['name' => 'Jasper', 'trait' => 'Loves to dig', 'image' => '13.jpg'],
            ['name' => 'Bandit', 'trait' => 'Mischievous spirit', 'image' => '14.jpg'],
            ['name' => 'Scout', 'trait' => 'Always exploring', 'image' => '15.jpg'],
            ['name' => 'Sammy', 'trait' => 'Loves everyone', 'image' => '16.jpg'],
            ['name' => 'Dexter', 'trait' => 'Smart and quick', 'image' => '17.jpg'],
            ['name' => 'Ziggy', 'trait' => 'Playful clown', 'image' => '18.jpg'],
            ['name' => 'Diesel', 'trait' => 'Strong and sturdy', 'image' => '19.jpg'],
            ['name' => 'Harley', 'trait' => 'Loves car rides', 'image' => '20.jpg'],
            ['name' => 'Bentley', 'trait' => 'Sophisticated pup', 'image' => '21.jpg'],
            ['name' => 'Murphy', 'trait' => 'Loves to chase', 'image' => '22.jpg'],
            ['name' => 'Riley', 'trait' => 'Happy-go-lucky', 'image' => '1.jpg'],
            ['name' => 'Baxter', 'trait' => 'Loves to bark', 'image' => '2.jpg'],
            ['name' => 'Hank', 'trait' => 'Country dog at heart', 'image' => '3.jpg'],
            ['name' => 'Louie', 'trait' => 'Loves music', 'image' => '4.jpg'],
            ['name' => 'Ollie', 'trait' => 'Loves to roll over', 'image' => '5.jpg'],
            ['name' => 'Rocco', 'trait' => 'Tough but sweet', 'image' => '6.jpg'],
            ['name' => 'Peanut', 'trait' => 'Small but mighty', 'image' => '7.jpg'],
            ['name' => 'Moose', 'trait' => 'Big and friendly', 'image' => '8.jpg'],
            ['name' => 'Oreo', 'trait' => 'Black and white beauty', 'image' => '9.jpg'],
            ['name' => 'Pepper', 'trait' => 'Spicy personality', 'image' => '10.jpg'],
            ['name' => 'Koda', 'trait' => 'Loves the forest', 'image' => '11.jpg'],
            ['name' => 'Copper', 'trait' => 'Shiny and bright', 'image' => '12.jpg'],
            ['name' => 'Marley', 'trait' => 'Loves reggae', 'image' => '13.jpg'],
            ['name' => 'Benny', 'trait' => 'Always cheerful', 'image' => '14.jpg'],
            ['name' => 'Teddy', 'trait' => 'Soft and cuddly', 'image' => '15.jpg'],
            ['name' => 'Winston', 'trait' => 'Distinguished gentleman', 'image' => '16.jpg'],
            ['name' => 'Gunner', 'trait' => 'Ready for action', 'image' => '17.jpg'],
            ['name' => 'Ranger', 'trait' => 'Loves the wilderness', 'image' => '18.jpg'],
            ['name' => 'Boomer', 'trait' => 'Loud and proud', 'image' => '19.jpg'],
            ['name' => 'Titan', 'trait' => 'Larger than life', 'image' => '20.jpg'],
            ['name' => 'Champ', 'trait' => 'Winner at everything', 'image' => '21.jpg'],
            ['name' => 'Blaze', 'trait' => 'Fast as lightning', 'image' => '22.jpg'],
            ['name' => 'Hunter', 'trait' => 'Great tracker', 'image' => '1.jpg'],
            ['name' => 'Storm', 'trait' => 'Powerful presence', 'image' => '2.jpg'],
            ['name' => 'Shadow', 'trait' => 'Follows everywhere', 'image' => '3.jpg'],
            ['name' => 'Spike', 'trait' => 'Tough exterior, soft heart', 'image' => '4.jpg'],
            ['name' => 'Dash', 'trait' => 'Super speedy', 'image' => '5.jpg'],
            ['name' => 'Chief', 'trait' => 'Natural leader', 'image' => '6.jpg'],
            ['name' => 'Maple', 'trait' => 'Sweet as syrup', 'image' => '7.jpg'],
            ['name' => 'Daisy', 'trait' => 'Bright and cheerful', 'image' => '8.jpg'],
            ['name' => 'Rosie', 'trait' => 'Pretty in pink', 'image' => '9.jpg'],
            ['name' => 'Coco', 'trait' => 'Rich and smooth', 'image' => '10.jpg'],
            ['name' => 'Honey', 'trait' => 'Sweet disposition', 'image' => '11.jpg'],
            ['name' => 'Ruby', 'trait' => 'Precious gem', 'image' => '12.jpg'],
            ['name' => 'Stella', 'trait' => 'Shines bright', 'image' => '13.jpg'],
            ['name' => 'Zoe', 'trait' => 'Full of life', 'image' => '14.jpg'],
            ['name' => 'Penny', 'trait' => 'Worth her weight in gold', 'image' => '15.jpg'],
            ['name' => 'Sadie', 'trait' => 'Sweet and loyal', 'image' => '16.jpg'],
            ['name' => 'Molly', 'trait' => 'Loves to play', 'image' => '17.jpg'],
            ['name' => 'Maggie', 'trait' => 'Motherly instincts', 'image' => '18.jpg'],
            ['name' => 'Sophie', 'trait' => 'Wise beyond her years', 'image' => '19.jpg'],
            ['name' => 'Chloe', 'trait' => 'Elegant and graceful', 'image' => '20.jpg'],
            ['name' => 'Lily', 'trait' => 'Pure and innocent', 'image' => '21.jpg'],
            ['name' => 'Mia', 'trait' => 'Small but fierce', 'image' => '22.jpg'],
            ['name' => 'Nala', 'trait' => 'Regal and proud', 'image' => '1.jpg'],
            ['name' => 'Piper', 'trait' => 'Loves to sing', 'image' => '2.jpg'],
            ['name' => 'Gracie', 'trait' => 'Graceful dancer', 'image' => '3.jpg'],
            ['name' => 'Hazel', 'trait' => 'Beautiful eyes', 'image' => '4.jpg'],
            ['name' => 'Ivy', 'trait' => 'Loves to climb', 'image' => '5.jpg'],
            ['name' => 'Willow', 'trait' => 'Flexible and adaptable', 'image' => '6.jpg'],
            ['name' => 'Autumn', 'trait' => 'Loves fall leaves', 'image' => '7.jpg'],
            ['name' => 'Ginger', 'trait' => 'Spicy personality', 'image' => '8.jpg'],
            ['name' => 'Paisley', 'trait' => 'Unique patterns', 'image' => '9.jpg'],
            ['name' => 'Roxy', 'trait' => 'Rock and roll spirit', 'image' => '10.jpg'],
            ['name' => 'Lexi', 'trait' => 'Smart and quick', 'image' => '11.jpg'],
            ['name' => 'Ellie', 'trait' => 'Loves elephants', 'image' => '12.jpg'],
            ['name' => 'Abby', 'trait' => 'Loves to hug', 'image' => '13.jpg'],
            ['name' => 'Kenzie', 'trait' => 'Scottish heritage', 'image' => '14.jpg'],
            ['name' => 'Lacey', 'trait' => 'Delicate and pretty', 'image' => '15.jpg'],
            ['name' => 'Misty', 'trait' => 'Mysterious aura', 'image' => '16.jpg'],
            ['name' => 'Dixie', 'trait' => 'Southern charm', 'image' => '17.jpg'],
            ['name' => 'Sasha', 'trait' => 'Russian beauty', 'image' => '18.jpg'],
            ['name' => 'Bonnie', 'trait' => 'Beautiful Scottish lass', 'image' => '19.jpg'],
            ['name' => 'Trixie', 'trait' => 'Loves tricks', 'image' => '20.jpg'],
            ['name' => 'Nikki', 'trait' => 'Victory in Greek', 'image' => '21.jpg'],
            ['name' => 'Sheba', 'trait' => 'Queen of the pack', 'image' => '22.jpg'],
            ['name' => 'Fiona', 'trait' => 'Fair and beautiful', 'image' => '1.jpg'],
            ['name' => 'Cassie', 'trait' => 'Loves to explore', 'image' => '2.jpg'],
            ['name' => 'Josie', 'trait' => 'Cheerful companion', 'image' => '3.jpg'],
            ['name' => 'Minnie', 'trait' => 'Small and sweet', 'image' => '4.jpg'],
            ['name' => 'Dolly', 'trait' => 'Loves to dress up', 'image' => '5.jpg'],
            ['name' => 'Fancy', 'trait' => 'Always dressed to impress', 'image' => '6.jpg'],
            ['name' => 'Princess', 'trait' => 'Royalty in the making', 'image' => '7.jpg'],
            ['name' => 'Angel', 'trait' => 'Heavenly disposition', 'image' => '8.jpg'],
            ['name' => 'Diamond', 'trait' => 'Precious and rare', 'image' => '9.jpg'],
        ];

        $simon = User::first();

        $optimizer = new OptimizeWebpImageAction();

        foreach ($puppies as $puppy) {

            // Optimize the image
            $input = base_path('seed-images/' . $puppy['image']);
            $optimized = $optimizer->handle($input);

            // Grab the path of the image
            $path = 'puppies/' . $optimized['fileName'];

            // Store that image
            Storage::disk('public')->put($path, $optimized['webpString']);

            Puppy::create([
                'user_id' => $simon->id,
                'name' => $puppy['name'],
                'trait' => $puppy['trait'],
                'image_url' => Storage::url($path),
            ]);
        }
    }
}
