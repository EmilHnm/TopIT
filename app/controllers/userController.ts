import { UserInterface } from '../models/interface/userInterface';
import User from '../models/user';

export class userController {
    constructor() {}

    public static index(): UserInterface[] {
        let users = <UserInterface[]>User.query().select('*');

        return users;
    }
}
