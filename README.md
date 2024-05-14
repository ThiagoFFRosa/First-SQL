# First-SQL
That's my first project trying do develop a SQL integration with HTML PHP and SQL there I gonna put my recent experience with it and some tips

so lets talk about it, in my first experience the first issue I'v got is to implement an SQL server I did it in 2 ways

Downloading SQL through their website (I do not recommend)
*why*? - Too difficult and for newbyes like me its not an experience that I'v understand everything (I do recommend for thoses who want to create a full browser website for a job or smf)

Using XAMPP (recommended)
*why*? - it's already comes with an localhost server (that u can use with your site with no ploblems) and it's very easy to setup
*remember that this is MY PERSONAL experience I'm not a senior DEV or smf to say that this our the other is BETTER just saying about a simple experience installing and using it*

so implementation

I'v used PHP to link my sql to my website (helps from gpt) you gonna need the Database that u wanna use (u can create one going to localhost/phpmyadmin in xampp) an user (i'v used "root" that haves no password (on my pc)) the server name (if u are in XAMPP just use localhost) if u use an other pc to link as a Database u gonna need the IP probably (I don't know I didn't used it) ant that's all u probably want to see if the connection is ok so I'v use this command (on my files its on scripts/conexao.php) 
"if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: <-( error in connection to DATA BASE ) " . $conn->connect_error);
}"

so after this u can select things from your DB and work with it

some recomendations u can link the connection to a single php file and request the connection for the others using 'require_once' this feature requires the php script and the connection remains in cache so every time u need to connect u don't need to ask for another connection again.

some useful subclasses

ativo (active) = u can determine if the user is active or not so u can make a user inactive by changing a value and not deleting him from your DB
Nivel_id = this links with another table where u can create classes the classes can have different permissions and requests
I'm not using sessions verifyers in the script so if u change the link to join in the admin link u can easily acces it

for now is this what I'v learned!
