class Base {
    public static function whoAmI() {
        return get_called_class();
    }
}

class User extends Base {}

print Base::whoAmI(); // prints "Base"
print User::whoAmI(); // prints "User"
