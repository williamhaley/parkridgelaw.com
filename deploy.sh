#!/bin/bash

rsync --delete -vr --delete-excluded \
	--include="php" --include="php/*" \
	--include="www" --include="www/*" \
	--exclude="*" \
	 . will@45.55.187.55:/srv/nginx/parkridgelaw.com/
