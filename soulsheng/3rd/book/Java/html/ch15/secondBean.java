//secondBean.java
import java.awt.*;
public class secondBean extends Canvas{
	//indexed����
	int[] data_array={0,1,2,3,4,5};
	//���췽��
	public secondBean(){
		setBackground(Color.green);
		setForeground(Color.blue);
	}
	//������������
	public void setData_array(int[] x){
		data_array=x;
	}
	//���õ���Ԫ��ֵ
	public void setData_array(int idx,int x){
		data_array[idx]=x;
	}
	//ȡ����������ֵ
	public int[] getData_array(){
		return data_array;
	}
	//ȡ�������е�ָ��Ԫ��ֵ
	public int getData_array(int idx){
		return data_array[idx];
	}
}
	