Npm packages which you need:
   <br/> -npm i axios
    <br/>-npm i vue
    <br/>-npm i vue2-google-maps
    <br/>-npm i vue-router
   <br/> -npm i vue-loader

Add to env file:
    <br/>THEME=maps
   <br/> GOOGLE_MAPS_API_KEY=AIzaSyBjR-olNjXwUPM5WcuZYCgcOBxF61sNByU
   
Run this for authentificate:
   <br/> composer require laravel/jetstream
   <br/> php artisan jetstream:install livewire
    
Add this code to 'store' method in vendor\laravel\fortify\src\http\controllers\RegisteredUserController:

    DB::table('role_user')->insert([
            'user_id' => $user->id,
            'role_id' => 2
     ]);
     
Also you need to type in console:
    <br/>php artisan migrate
    <br/>php artisan db:seed
    
In the end, you need to type in console 'npm run dev'
