# rocket-test
This is a test project built on RocketSled framework

You can view this project demo on the following url:

http://cape-canaveral.herokuapp.com

*Wondering why naming the application is called `cape-canaveral` ? 
Google the thing and it will make sense... 
Still don't get it ?... 
The application is built on `RocketSled` microframework, 
and `cape-canaveral` is a name for the rocket that shall be launched in near future... **ahem**.*

## Installation on local
Clone or Download this repository and move the source to your `www` / `htdocs` directory.

Configure Your vhost to open `/public` subdirectory instead of document root.

Open `your-vhost-name.dev/` if you have configured to `public` directory, or `your-vhost-name.dev/public` to open up the application.

If you don't know how to setup a vhost, go ask Google, he will know better...

When you go to `your-vhost-name.dev/?r=SomeRoute`, then the `SomeRoute` action will be executed (View the list of actions below).

Download the sql dump from the links section below and execute / run it on Your target machine

*example on how to execute sql files*
```shell
mysql -u username -p database_name < file.sql
```
Or [view](https://stackoverflow.com/questions/17666249/how-to-import-an-sql-file-using-the-command-line-in-mysql) this thread on stackoverflow

After this you [probably] will have no problem using the application.

## App capabilities
Application allows the users to register on the public site, logout, 
login and request a new password if You have forgotten the previous one.
As this project is meant to be a test task, the forgot password functionality
is working in very simple and stupid way (don't ask about it, no time for that fancy sh*t)

After logging in the system, you will be able to see the list of messages you have 
[pretended] sent to recipients. You can click on a `New Message` button to [pretend] send 
new message to another recipient.

Administrator can see all the conversations (not messages, just the user - receiver relations) that have taken place.

## Internal Links / Sitemap
- [Index](http://cape-canaveral.herokuapp.com/?r=Index)
- [Login](http://cape-canaveral.herokuapp.com/?r=Login)
- [ForgotPassword](http://cape-canaveral.herokuapp.com/?r=ForgotPassword)
- [Register](http://cape-canaveral.herokuapp.com/?r=Register) 
- [Dashboard (Requires Login)](http://cape-canaveral.herokuapp.com/?r=Dashboard)
- [NewMessage (Requires Login)](http://cape-canaveral.herokuapp.com/?r=NewMessage)
- [AdminAuth](http://cape-canaveral.herokuapp.com/?r=AdminAuth)
- [AdminDashboard (Requires Admin Login)](http://cape-canaveral.herokuapp.com/?r=AdminDashboard)
- [AdminReceivers (Requires Admin Login)](http://cape-canaveral.herokuapp.com/?r=AdminReceivers)

*Note: In order to be able to login to admin side using AdminAuth route, you need to have a little bit of trivia about Game of Thrones. If You try to login with incorrect values, it will give You a hint.*

## External Links
- [SQL Dump](https://mega.nz/#!X48zUYTA!tG5h2aS3eu8JcVjOcOeSM9KGRJOA52UptoRvgZAOJko)

![Database Structure ER Diagram](https://lh3.googleusercontent.com/Xiw7b1ZXtuhCHT4sy9B0jdEyriA1L6rURzAAUVMpiMuY4qTVL9Yc1nQQS50Et-TYwhH7061lMOBJAV3T3XvAlYPQJPscbxuoK_7jt9uufaYk72U96mFg7fZ0yjDq8kVsjGOt3m0lWdgXp8BP42gcMLtFHfVM5jrgipF1D2Bf-_AS-E3eswlRwXiMG78QCQjpO_PLGUpF0gGsgkLOODCSNE26Me6QJoKd673Ou3qowK6lWvf4inQZSMHEn5kuevvPfNYwYqH8Rt5i7RaMlNJeqYKdZiTb1mhhzRQOthTnF1wv_HrZWgheNpj9KSncbkdMuYfSJwb6A4hFnCh6bgxCV-I7kpXAAupVmxbwr2-k6hV-JENvks3kEqIr4Hox59mgKdxD-8BnMNkvWWhy7-tr1O7zT8J4HafhoN67-bYtvtCLGIFvBtUIG2S74xEogsZyXKhAKz3mAM9colt8Kvls9gwGRERws7XnlJF6ZCSfKmp3KaOcef7t7KRgCHBu0_Q3moF1CfH8EC9z1qPxfCUtQWoJItjaIhj_z4Qq-pcKSL-uswQsALqH1go-CgvSKcY1_-Eu8bk5PTgSZMdt9lEeqh8roJrmuHRjHu3gnVtWvlsFZzMiX19U3Qer=w661-h380-no "Database Structure ER Diagram")

*TODO*
- Add CSRF Protection
- Add XSS Protection
- Add some test cases