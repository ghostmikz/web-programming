# Web Programming

PHP labs for the Web Programming class. Runs on XAMPP/LAMPP: put this folder in `htdocs` as `lab` and open `http://localhost/lab/lab01/convert.php`.

- **Lab 1** - Unit converter (`lab01/convert.php`)
- **Lab 2** - Login with sessions and a product list (`lab02/login_form.php`)
- **Lab 3** - Unit converter with the last 5 conversions saved in the session (`lab03/convert_lab03.php`)
- **Lab 4** - Poll that saves votes to a text file and uses a cookie to stop double voting (`lab04/poll.php`)
- **Lab 5** - Pet register / list / edit / delete / search with MySQL (`lab05/list.php`)

Lab 5 needs a MySQL database `webprogramming` with a `pet` table:
`petid` int auto_increment primary key, `name` varchar(20), `owner` varchar(20), `type` varchar(20), `gender` char(1), `birth` date, `death` date.
