let data = new Date();



let hours = data.getHours();
let min = data.getMinutes();
let second = data.getSeconds();
 
    let liczba=0;
    const interval = setInterval(()=>{
    console.log(hours+":"+min+":"+second);
        if(liczba===5)
        {
            clearInterval(interval);
        }
        liczba++;
    },1000);
    //