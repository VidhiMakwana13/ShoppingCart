const express = require('express');
const axios = require('axios');
const app = express();

app.get('/api/phpdata', async (req, res) => {
    try {
        const response = await axios.get('http://localhost/PA3/php_rest_api.php');
        res.json(response.data);
    } catch (error) {
        res.status(500).send('Error fetching data');
    }
});

app.listen(3000, () => console.log('Server running on port 3000'));
