public class ch4ex12{
	public static void main(String[]args){
		String s1="Computing includes five subject,that is CE CS SE IT IS.";
		String word;
		int j,t,count;
		//����ĳ���������������
		int te[]=new int[3];
		System.out.println(s1);
		j=0;
		while((s1.indexOf(' ',j)!=-1)||(s1.indexOf(',',j)!=-1)||(s1.indexOf('.',j)!=-1)){
		//���߹�ϵΪ��,ֻҪһ������˵���ҵ�������,��֮,�Ѿ������ַ���ĩβ
			count=0;
			if(s1.indexOf(' ',j)!=-1)
				te[count++]=s1.indexOf(' ',j);
			//te�����ſո�λ�ú��±��1
			if(s1.indexOf(',',j)!=-1)
				te[count++]=s1.indexOf(',',j);
			//te�����Ŷ���λ�ú��±��1
			if(s1.indexOf('.',j)!=-1)
				te[count++]=s1.indexOf('.',j);
			//����ð������,ʹ��te[0]Ϊ��С
			for(int i=0;i<count;i++)
				for(int k=0;k<count-i-1;k++)
					if(te[k]>te[k+1]){
						t=te[k];te[k]=te[k+1];te[k+1]=t;
					}
			//������������ǰ�ı�����
			t=te[0];
			word=s1.substring(j,t);
			System.out.println(word);
			j=t+1;
		}
	}
}		