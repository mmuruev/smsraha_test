<?php
namespace app\env;


class Constants
{

    /**
     *  Account table
     */
    const ACCOUNT_TABLE = 'user_account';

    /**
     *  Active user  data
     */
    const USER_DATA_TABLE = 'user_data';

    /**
     *  History table
     */
    const HISTORY_TABLE = 'history';

    /**
     *  Id field
     */
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

    /**
     *  First name field
     */
    const FIRST_NAME_FIELD = 'first_name';
    /**
     *  Second name field
     */
    const SECOND_NAME_FIELD = 'second_name';
    /**
     *  email field
     */
    const EMAIL_FIELD = 'email';
    /**
     *  Phone field
     */
    const PHONE_FIELD = 'phone';
    /**
     *  Birthday field
     */
    const BIRTHDAY_DATE_FIELD = 'birthday';
    /**
     * Action field
     */
    const ACTION = 'action';
    /**
     *  CREATE action
     */
    const CREATE_ACTION = 'CREATED';
    /**
     *  UPDATE action
     */
    const UPDATE_ACTION = 'UPDATED';
    /**
     *  DELETE action
     */
    const DELETE_ACTION = 'DELETED';
}