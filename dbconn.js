var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "rda",
  database: "mydb"
});
con.connect();
 
 
  console.log("Connected!");
 var query= con.query("CREATE table db (aakash int);", function (err, result) {
    if (err) throw err;
    console.log("table created");
    
    console.error(err);
  });
