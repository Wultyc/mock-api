# How to run this container
First build the image
    docker build --tag wultyc:mockapi .

Then run it in interactive mode with access to a bash
    docker run -it -p 8080:80 wultyc:mockapi

Then run it in background mode
    docker run -dt -p 8080:80 wultyc:mockapi

> Aldo theres a port bind on dockerfile, -p para is necessary to be able to run this service on Windows or Mac machines 