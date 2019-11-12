# Demo of Monolog / Logstash / Elastic

This project demonstrates connecting your PHP application logs to an ELK stack.

We push logs to a local Logstash instance rather than connecting to Elasticsearch over the network.  This allows low latency in our app and sets up a buffer in case Elastic is temporarily unavailable.

## Running the project

First set up the project by editing `docker/config/logstash/logstash.conf`
and inserting your AWS details into the `output` plugin config at the bottom.

Then use these commands:

    cd docker
    docker-compose up -d
    docker exec -it php /bin/bash
    composer install
    
And then visit `http://localhost:8000` in your browser.  After that you can use Kibana on your instance to view the log.

Logstash will push to your AWS instance, and also to stdout (your docker logs).

## Grokking your own logs

These sites are very useful:

* https://grokdebug.herokuapp.com/
* https://github.com/logstash-plugins/logstash-patterns-core/blob/master/patterns/grok-patterns
* https://github.com/kkos/oniguruma/blob/master/doc/RE

Oniguruma lets you use regex in the Grok pattern, like this: `(?<field_name>the pattern here)`