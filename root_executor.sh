#!/bin/bash
if [ -f /tmp/rootcmd.sh ]; then
    bash /tmp/rootcmd.sh
    rm /tmp/rootcmd.sh
fi
