import java.util.Scanner;

public class ornek {
    public static void main(String[] args) {
        Scanner scanner = new Scanner (System.in);

        System.out.println("Satir sayisi : ");
        int satir = scanner.nextInt();

        System.out.println("Sutun sayisi : ");
        int sutun = scanner.nextInt();

        for(int i = 0; i < satir; i++){
            if(i == 0 || i == satir - 1){
                System.out.print("o");
            }else {
                System.out.print("-");
            }
        }
        System.out.println();

        for(int i = 0;i < sutun - 2;i++){
            System.out.print("|");
            for(int j = 0; j<satir - 2; j++){
                System.out.print(" ");
            }
            System.out.println("|");
        }
        for (int i = 0; i< satir; i++){
         if(i == 0 || i == satir -1){
             System.out.print("o");
          }else {
             System.out.print("-");
          }
        }
        System.out.println();
    }
}
