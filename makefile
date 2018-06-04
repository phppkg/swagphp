# link https://github.com/humbug/box/blob/master/Makefile
#SHELL = /bin/sh
.DEFAULT_GOAL := help
# 每行命令之前必须有一个tab键。如果想用其他键，可以用内置变量.RECIPEPREFIX 声明
# mac 下这条声明 没起作用 !!
.RECIPEPREFIX = >
.PHONY: all usage help clean

# 需要注意的是，每行命令在一个单独的shell中执行。这些Shell之间没有继承关系。
# - 解决办法是将两行命令写在一行，中间用分号分隔。
# - 或者在换行符前加反斜杠转义 \

##there some make command for the project
##

help:
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//' | sed -e 's/: / /'

##Available Commands:

  all:        ## Run all the commands for the entire publishing process
all: route apidoc phar pbimg

  pbAssets:   ## Publish npm assets to web/assets/lib
pbAssets:
	mkdir web/assets/lib/element-ui web/assets/lib/axios web/assets/lib/vue web/assets/lib/vue-router
	cp node_modules/element-ui/lib/index.js web/assets/lib/element-ui/
	cp node_modules/axios/dist/axios.min.js web/assets/lib/axios/
	cp node_modules/vue/dist/vue.min.js web/assets/lib/vue/
	cp node_modules/vue-router/dist/vue-router.min.js web/assets/lib/vue-router/
