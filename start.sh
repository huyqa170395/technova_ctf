#!/bin/bash

# Start cron as root
cron

# Switch to alice.nguyen and run Apache
exec su -c "apache2-foreground" alice.nguyen
