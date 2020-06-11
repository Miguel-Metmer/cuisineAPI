class test
{
    call()
    {
        fetch("https://127.0.0.1:8000/recettes")
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            this.draw(data);
        })
        .catch((err) => {
            throw err;
        })
    }

    draw(data)
    {
        let tab = [];

        for(let i = 0; i < data.length; i++)
        {
            tab.push(data[i]);
        }

        console.log(data);
        console.log(tab[1].ingredients);

        let el = document.getElementById("in")

        el.innerHTML = tab[0].ingredients;
    }
}

let tt = new test();
tt.call();