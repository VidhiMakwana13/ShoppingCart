const express = require('express');
const app = express();
const PORT = 3000;

app.get('/api/students', (req, res) => {
    const students = [
        { name: 'John Doe', age: 20, email: 'john@example.com' },
        { name: 'Jane Smith', age: 22, email: 'jane@example.com' }
    ];
    res.json(students);  // Send a JSON response
});

app.listen(PORT, () => {
    console.log(`Express server running on http://localhost:${PORT}`);
});
