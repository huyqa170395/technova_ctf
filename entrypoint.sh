#!/bin/bash

# Start SSH service
service ssh start

# Start cron (for privilege escalation backdoor)
service cron start

# Start Apache in foreground
exec apache2-foreground