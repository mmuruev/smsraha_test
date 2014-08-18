<?php
namespace app\env;


class Constants
{

    /**
     *  Account table
     */
    const ACCOUNT_TABLE = 'user_account';

    const ID_FIELD = 'id';

    const UPDATED_AT = 'updated';

    // SECURITY ROLES
    /**
     *  Security role field
     */
    const ROLE_FIELD = 'roles';
    /**
     *  Admin role as root for panel
     */
    const ROLE_ADMIN = 'ROLE_ADMIN';
    /**
     *  Regular system user role
     */
    const ROLE_USER = 'ROLE_USER';

    /**
     *  User name field
     */
    const NAME_FIELD = 'name';
    /**
     *  User name field
     */
    const USER_FILED = 'user';
    /**
     *  Admin user name
     */
    const ADMIN_USER = 'admin';
    /**
     *  Password field name
     */
    const PASSWORD_FIELD = 'password';
} 