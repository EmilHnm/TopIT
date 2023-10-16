import DB from '../../config/database';
import { UserInterface } from './interface/userInterface';

class User implements UserInterface {
    constructor(
        public id: number,
        public name: string,
        public email: string,
        public user_type: string,
        public phone_number: string,
    ) {}

    public static query() {
        return DB('users');
    }
}

export = User;
