const http = require('http'); //ipmortowanie modułu http


const server = http.createServer((req,res)=>{

   if(req.url==='/'){
    res.write("Witaj na stronie glownej");
    res.end();
   }else if(req.url === '/contact'){
    res.write("to jest strona kontaktowa");
    res.end();
   }else{
    res.write("404 - PAGE NOT FOUND");
    res.end();
   }

});

server.listen(3000,'127.0.0.1',()=>{
    console.log("Serwer działa na porcie 3000 i adresie http://127.0.0.1:3000/");
});