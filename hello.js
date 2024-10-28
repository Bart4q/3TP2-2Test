let liczba = 0;

const interval = setInterval(()=>{
    console.log(liczba);
    if(liczba===5)
    {
        clearInterval(interval);
    }
    liczba++;
},1000);