const http = require('http'); //ipmortowanie modułu http


const server = http.createServer((req,res)=>{

    res.writeHead(200, {'Content-Type':'test/plain'});
    res.end("Serwer działa\n");

});

server.listen(3000,'127.0.0.1',()=>{
    console.log("Serwer działa na porcie 3000 i adresie http://127.0.0.1:3000/");
});