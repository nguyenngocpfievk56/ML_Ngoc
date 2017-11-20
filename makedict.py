# coding: utf-8
import MeCab

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
# upthreshold = int(0.95 * len(lvdDict))
# lvdDict =  lvdDict[0:upthreshold]

fdict = open("dict.txt", "w")
for item in lvdDict:
    if (item[1] > 1):
        # fdict.write("%s\t%d\n" % (item[0], item[1]))
        fdict.write("%s\n" % (item[0]))
fdict.close()