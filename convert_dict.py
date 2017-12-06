# coding: utf-8

f = open('dict.txt')
lines = f.readlines()
f.close()

fdict = open("lavida_dict.txt", "w")
for line in lines:
  word = line.rstrip()
  if word:
    fdict.write("%s,*,*,1,名詞,固有名詞,*,*,*,*,%s,%s,%s\n" % (word, word, word, word))

fdict.close()
