#!/bin/bash
localPATH=`pwd`                          # path of current directory
sep='---------------'
for d in */; do
  echo $sep"Checking Status of" $d$sep
  d=`echo $d | sed s#/##`                # remove trailing forward slash
  git -C $localPATH/$d checkout master   # checkout master in different directory
  git -C $localPATH/$d status            # run git status
  echo -e '\n'
done.
