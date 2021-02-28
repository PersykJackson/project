
async function sendGet(url)
{
    try {
        const result = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        return await result.json()
    } catch (error) {
        console.log(error.message)
    }
}

async function sendPost(url, data)
{
    try {
        const result = await fetch(url, {
            method: 'POST',
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify(data)
        });
        return await result.json()
    } catch (error) {
        console.log(error.message)
    }
}

async function reload()
{
    const uri = window.location.href;
    const answer = await sendGet(uri)

    let newWrap = document.createElement('div')
    newWrap.innerHTML = answer
    newWrap = newWrap.getElementsByClassName('wrapper').item(0)

    let oldWrap = document.getElementById('wrapper')
    oldWrap.innerHTML = newWrap.innerHTML

}