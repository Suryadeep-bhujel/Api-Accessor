 
# Api-Accessor
Api Accessor is package to protect your application api for laravel.If you are developing your application  it will helpful for you to extend your application. 

<h4><strong>Compatible for </strong></h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Laravel Version </th>
            <th>Version</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>8.*</td>
            <td>1.*</td>
        </tr>
    </tbody>
</table>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### prerequisites
- Composer 
- PHP 7.3 or 8.*
- MySql or Mongodb 
- If  mongodb database in application as primary  database  <a href="https://github.com/jenssegers/laravel-mongodb">https://github.com/jenssegers/laravel-mongodb</a> 
- Laravel 8.*
- Laravel Helpers

## Installation of the package 
- Run the below command to install package  
```bash 
composer require bhujel/secret-header
```
<p>Package will install  inside your laravel application.</p>
- Run the below command to copy config file inside  config 

```bash 
  php artisan vendor:publish --tag=api-accessor
```
<p> You can make changes of your database information and requirement for your application to   apply for the package processing </p>
- After successfully publishing vendor api_processor.php will appear in config file inside your root application. 
- Api Processor assets file is auto generated inside your public directory. 
- Now you need table  to store api keys , run the below command to migrate the table, it will create access_keys and access_key_usages table in your database 

```bash 
  php artisan migrate
```
-Now your package is ready  you can visit access dashboard using  your {your app url}/dashboard/accessor

```bash 
   {your app url}/dashboard/accessor
```
<p>Access Key list is below url</p> 

```bash 
   {your app url}/dashboard/access_keys
```

<p> You can add TEST or LIVE API ACCESS keys and maintain your api if required.</p>


### Using  in API 
<p> You can customize and use keys on your api request</p>
- Add on your api header to access your api. Once the package is installed you can only able to access your api  after adding and managing at least on api key. 

1. Add one api key with active status. 
2. From api_processor.php file inside your config dir of application has predefined keys for package. Default api access key header is 
```bash 
API-ACCESS-KEY 
```
<p> but recomanded to setup your custom key name.</p>
<p> Copy and add paste your api key to your key name header. </p>
3. default it will resposes html on failed to access api  you can  manage response from handler.php file. 
4. If the api key is valid and accessible then you are now able to play on your apis.
