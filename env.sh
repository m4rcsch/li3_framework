#!/bin/bash

export PS1='\e[0;31m[lithium]\e[m\[\e]0;\u@\h: \w\a\]${debian_chroot:+($debian_chroot)}\u@\h:\w\$ '

current="`pwd`/libraries/lithium/console"
export PATH=$current:$PATH
echo "== set new Path =="
echo $PATH

echo "call:"
echo "li3 --env=development"
echo "for development env!"
