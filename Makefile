.PHONY:


help:
		cat Makefile


# environment
env:
		cp -p .env.docker .env

chmod:
		chmod 777 -R storage
		chmod 777 -R bootstrap/cache


# Node.js
npmi:
		npm install
npmd:
		npm run dev
npmw:
		npm run watch
npmrb:
		npm rebuild node-sass


# Laravel
vendor: composer.json composer.lock
		composer self-update
		composer validate
		composer install

dump:
		composer dump-autoload

clear:
		composer clear-cache
		php artisan view:clear
		php artisan route:clear
		php artisan clear-compiled
		php artisan config:cache

opt: clear
		php artisan cache:clear
		#php artisan optimize

clr: opt dump

test:
		vendor/bin/phpunit --configuration=phpunit.xml

#e2e:
#		php artisan dusk
