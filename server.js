const express= require('express');
const app= express();

const server= require('http').createServer(app);
const io = require("socket.io")(server, {
  cors:  {orgin: "*"}   
});

io.on('connection', (socket) => {
    console.log('a user connected');

    socket.on('sendChatToServer', (message)=>{
        console.log(message);


        socket.broadcast.emit('sendChatToClient', message);
    });

    socket.on('disconnect', (socket)=>{
        console.log(socket.username+'Disconnect');
    })
  });


server.listen(3000, () => {
    console.log('sever is running');
  });