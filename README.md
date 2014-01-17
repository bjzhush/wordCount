wordCount
=========

Count and analyze frequency of words from given contents

本工具主要用于辅助英语学习
比如我正在通过BBC或者CNN学习英语,必然有很多单词我不懂,传统的分析办法是遇到一个背诵一个,本程序的设计初衷,
通过分析已经阅读过的文章及爬虫爬取(比如指定BBC某些分类的文章),然后分析单词出现的频率,来有重点地对高频生词进行学习,从而达到最大化的效果

ToDo: 
1.持续对输入的所有URL进行分析,并将数据累加进行统计
2.支持批量传入url
3.支持通用和专用的white list,前者如 a an the of 之类的词,后者如可以自定义用户自己的已知单词
4.支持灵活的url源输入,如通过chrome的visited url hook到接口或者通过js书签添加url到分析库
5.重复url的剔除
6.待改进



V0.1
实现了一个简单的对于单个url的词频分析,输入一个URL,分析并给出此URL的内容里,出现频率最高的词


