public class ch4ex12{
	public static void main(String[]args){
		String s1="Computing includes five subject,that is CE CS SE IT IS.";
		String word;
		int j,t,count;
		//数组的长度与标点符号数相等
		int te[]=new int[3];
		System.out.println(s1);
		j=0;
		while((s1.indexOf(' ',j)!=-1)||(s1.indexOf(',',j)!=-1)||(s1.indexOf('.',j)!=-1)){
		//三者关系为或,只要一个成立说明找到标点符号,反之,已经到达字符串末尾
			count=0;
			if(s1.indexOf(' ',j)!=-1)
				te[count++]=s1.indexOf(' ',j);
			//te数组存放空格位置后下标加1
			if(s1.indexOf(',',j)!=-1)
				te[count++]=s1.indexOf(',',j);
			//te数组存放逗号位置后下标加1
			if(s1.indexOf('.',j)!=-1)
				te[count++]=s1.indexOf('.',j);
			//利用冒泡排序,使得te[0]为最小
			for(int i=0;i<count;i++)
				for(int k=0;k<count-i-1;k++)
					if(te[k]>te[k+1]){
						t=te[k];te[k]=te[k+1];te[k+1]=t;
					}
			//三者中排列最前的标点符号
			t=te[0];
			word=s1.substring(j,t);
			System.out.println(word);
			j=t+1;
		}
	}
}		