var express = require('express');
var app = express();

app.use(express.json()); // allows our server to accept JSON requests
app.use(express.logger()); // logs all requests to the console

app.get('/heartbeat', function(request, response) {
    response.json(200, { message : "OK" });
});

app.listen(3000, function(){
    console.log('Express server listening on port 3000');
});