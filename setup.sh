#!/bin/bash

# Create database and table schema
mysql < schema.sql

# Start the cron job 
cron
