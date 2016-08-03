---
layout: post
title: start-ptr 
meta: 
tag: c++, startptr
projectdue: 
catagory:
date: 2016-7-22
---

pointer 의 문재점은 너무이르게 함수를 리턴할 경우 함수가 다끝나기 전에 예외처리를 할 경우 둘다 delete를 하지 못한다는 한계를 가지고 있다. 

{% %}
void main(){
	A* dataA = new A();
	A->foo();
	
	//try-catch
	//return	

	delete a;
	return 0;
}
{% %}

메모리 누수가 발생한다. 
