# coding: utf-8
import MeCab
from language_detect import detect_language

m = MeCab.Tagger()

f = open('alldata.txt')
lines = f.readlines()
f.close()

lvdDict = {}
validTag = ['サ変接続', '一般', '固有名詞', '代名詞']
for line in lines:
    tmp = m.parse(line)
    words = tmp.split('\n')
    for word in words:
        t1 = word.split('\t')
        if (len(t1) == 2):
            key = t1[0]
            props = t1[1].split(',')
            if (props[0] == '名詞' and (props[1] in validTag) and props[6] == '*'):
                if key in lvdDict:
                    lvdDict[key] += 1
                else:
                    lvdDict[key] = 1


lvdDict = sorted(lvdDict.items(), key=lambda x:x[1])
threshold = 2

fdict = open("dict.txt", "w")
for item in lvdDict:
    if (item[1] > threshold):
        language = detect_language(item[0])
        if ((language == 'en' and len(item[0]) > 1) or (language == 'ja' and len(item[0]) > 3)):
            print item[0]
            # fdict.write("%s\t%d\n" % (item[0], item[1]))
            fdict.write("%s\n" % (item[0]))
fdict.close()