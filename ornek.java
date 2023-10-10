import java.util.Scanner;

public class ornek {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        System.out.print("Sütun : "); //sütun
        int sutun = scanner.nextInt();

        System.out.print("Satır : "); //satır
        int satir = scanner.nextInt();
        if (satir >= 2 && sutun >= 2) {
            for (int i = 0; i < sutun; i++) {
                if (i == 0 || i == sutun - 1) {
                    System.out.print("o");
                } else {
                    System.out.print("-");
                }
            }
            System.out.println();

            for (int i = 0; i < satir - 2; i++) {
                System.out.print("|");
                for (int j = 0; j < sutun - 2; j++) {
                    System.out.print(" ");
                }
                System.out.println("|");
            }
            for (int i = 0; i < sutun; i++) {
                if (i == 0 || i == sutun - 1) {
                    System.out.print("o");
                } else {
                    System.out.print("-");
                }
            }
            System.out.println();
        }
        else if (sutun == 1 & satir > 0) {
            for (int i = 0; i < satir ; i++) {
                if(i == 0 || i == satir - 1)
                    System.out.println("o");
                else {
                    System.out.println("|");
                  }
                }
            }

         else if (satir == 1 & sutun > 0) {
            for (int i = 0; i < sutun; i++) {
                if (i == 0 || i == sutun - 1) {
                    System.out.print("o");
                } else {
                    System.out.print("-");
                }
            }
        }
         else if(satir <= 0 || sutun <=0) {
             System.out.println("Satir ya da sütun 0 olamaz!!");
                    }
    }
}
