
async function sendGet(url)
{
    try {
        const result = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'text/html'
            }
        });
        return await result.text()
    } catch (error) {
        console.log(error.message)
    }
}

async function sendPost(url, data = 'data')
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

async function sendFile(url, data)
{
    try {
        const result = await fetch(url, {
            method: 'POST',
            headers: {
    },
        body: data
    });
        return await result.json()
    } catch (error) {
        console.log(error.message)
    }
}