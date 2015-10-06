#Persistence Manager
Persistence Manager is a lightweight ORM based on concepts
borrowed from the laravel framework


#Testing
 The phpunit framework for testing is used to perform
 unit test on the classes. The TDD principle has been
 employed to make the application robust

 Run this on bash to execute the tests
 ```````bash
 /vendor/bin/phpunit
`````````

#Install

- To install this package, PHP 5.5+ and Composer are required

````bash
composer require verem/persitencemanager
``````

#usage

- Save a model in the database

````````
$user = new User();
$user->username = "john";
$user->password = "password";
$user->email = "john@doe.co";
$user->save();
`````````
- Find a model

``````
$user = User::find($id);
``````
- Update a record

``````
$user = User::find($id);
$user->password = "s†røngerPaSswoRd";
$user->save();
``````
- Delete a record -- returns a boolean

````````
$result = User::destroy($id):
````````

- Find a model based on column value

```````
$user = User::where('username', 'john');
``````



## Change log
Please check out [CHANGELOG](CHANGELOG.md) file for information on what has changed recently.

## Contributing
Please check out [CONTRIBUTING](CONTRIBUTING.md) file for detailed contribution guidelines.

## Credits
PersistenceManager is maintained by `Verem Dugeri`.

## License
Urban dictionary is released under the MIT Licence. See the bundled [LICENSE](LICENSE.md) file for more details.



